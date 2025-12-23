// 加载生词表
function loadVocabulary() {
  chrome.storage.local.get(['vocabulary'], (result) => {
    const vocabulary = result.vocabulary || [];
    const listContainer = document.getElementById('vocabulary-list');
    const wordCount = document.getElementById('word-count');
    
    wordCount.textContent = vocabulary.length;
    
    if (vocabulary.length === 0) {
      listContainer.innerHTML = `
        <div class="empty-state">
          <div class="emoji">📚</div>
          <p>生词表为空<br>选中单词后点击猫咪即可添加</p>
        </div>
      `;
      return;
    }
    
    // 按添加时间倒序排列
    vocabulary.sort((a, b) => new Date(b.addedAt) - new Date(a.addedAt));
    
    listContainer.innerHTML = vocabulary.map(item => {
      // 安全获取数据，提供默认值
      const word = item.word || '未知单词';
      const chinese = item.chineseTranslation || item.translation || '暂无翻译';
      const phonetic = item.phonetic || '';
      const audioUrl = item.audioUrl || '';
      const definitions = item.definitions || [];
      const examples = item.examples || [];
      const addedAt = item.addedAt ? new Date(item.addedAt).toLocaleString('zh-CN') : '未知时间';
      
      // 构建音标和发音按钮
      let phoneticHTML = '';
      if (phonetic) {
        phoneticHTML = `<span class="word-phonetic">${phonetic}</span>`;
      }
      if (audioUrl) {
        phoneticHTML += `<button class="audio-btn" data-audio="${audioUrl}" title="播放发音">🔊</button>`;
      }
      
      // 构建释义HTML
      let definitionsHTML = '';
      if (definitions.length > 0) {
        definitionsHTML = definitions.map(def => `
          <div class="word-definition">
            <span class="definition-pos">${def.pos || 'n.'}</span>
            ${def.definition || ''}
          </div>
        `).join('');
      }
      
      // 构建例句HTML
      let examplesHTML = '';
      if (examples.length > 0) {
        examplesHTML = examples.map(ex => `
          <div class="word-example">📝 ${ex}</div>
        `).join('');
      }
      
      return `
        <div class="vocabulary-item" data-word="${word}">
          <div class="word-header">
            <div class="word-title">
              <span class="word-text">${word}</span>
              ${phoneticHTML}
            </div>
            <button class="delete-btn" data-word="${word}">删除</button>
          </div>
          
          <div class="word-chinese">${chinese}</div>
          
          ${definitionsHTML}
          
          ${examplesHTML}
          
          <div class="word-date">添加于 ${addedAt}</div>
        </div>
      `;
    }).join('');
    
    // 添加删除按钮事件
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const word = e.target.getAttribute('data-word');
        deleteWord(word);
      });
    });
    
    // 添加发音按钮事件
    document.querySelectorAll('.audio-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const audioUrl = e.target.getAttribute('data-audio');
        if (audioUrl) {
          const audio = new Audio(audioUrl);
          audio.play().catch(err => console.log('音频播放失败:', err));
        }
      });
    });
  });
}

// 删除单词
function deleteWord(word) {
  if (!confirm(`确定要删除 "${word}" 吗？`)) {
    return;
  }
  
  chrome.storage.local.get(['vocabulary'], (result) => {
    const vocabulary = result.vocabulary || [];
    const newVocabulary = vocabulary.filter(item => item.word !== word);
    
    chrome.storage.local.set({ vocabulary: newVocabulary }, () => {
      loadVocabulary();
    });
  });
}

// 清空生词表
document.getElementById('clear-all').addEventListener('click', () => {
  if (!confirm('确定要清空所有生词吗？此操作不可恢复！')) {
    return;
  }
  
  chrome.storage.local.set({ vocabulary: [] }, () => {
    loadVocabulary();
  });
});

// 页面加载时加载生词表
loadVocabulary();

// 监听存储变化，实时更新
chrome.storage.onChanged.addListener((changes, namespace) => {
  if (namespace === 'local' && changes.vocabulary) {
    loadVocabulary();
  }
});
