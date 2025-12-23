// 猫咪元素
let cat = null;
let isFixed = false;
let isShowingTooltip = false;
let fixedPosition = { x: 0, y: 0 };
let currentWord = '';
let tooltip = null;
let lastClickTime = 0;
let clickCount = 0;

// 初始化猫咪
function initCat() {
  cat = document.createElement('div');
  cat.id = 'english-cat';
  cat.innerHTML = `
    <div class="cat-body">
      <div class="cat-ear cat-ear-left"></div>
      <div class="cat-ear cat-ear-right"></div>
      <div class="cat-face">
        <div class="cat-eye cat-eye-left"></div>
        <div class="cat-eye cat-eye-right"></div>
        <div class="cat-nose"></div>
        <div class="cat-mouth"></div>
      </div>
    </div>
  `;
  
  document.body.appendChild(cat);
  
  // 右键菜单 - 添加到生词表
  cat.addEventListener('contextmenu', (e) => {
    e.preventDefault();
    if (currentWord) {
      addToVocabulary(currentWord);
      showNotification('✅ 已添加到生词表！');
    }
  });
  
  // 创建提示框
  tooltip = document.createElement('div');
  tooltip.id = 'cat-tooltip';
  document.body.appendChild(tooltip);
  
  console.log('%c🐱 猫咪插件已加载！', 'color: #ff6b35; font-size: 16px; font-weight: bold;');
}

// 使用mousedown事件来检测双击
document.addEventListener('mousedown', (e) => {
  if (e.button !== 0) return;
  
  const currentTime = new Date().getTime();
  const timeDiff = currentTime - lastClickTime;
  
  if (timeDiff < 300) {
    e.preventDefault();
    toggleCatFixed(e);
    clickCount = 0;
  } else {
    clickCount = 1;
  }
  
  lastClickTime = currentTime;
}, true);

// 切换猫咪固定状态
function toggleCatFixed(e) {
  isFixed = !isFixed;
  
  if (isFixed) {
    fixedPosition.x = e.clientX + window.scrollX + 20;
    fixedPosition.y = e.clientY + window.scrollY + 20;
    cat.style.left = fixedPosition.x + 'px';
    cat.style.top = fixedPosition.y + 'px';
    cat.classList.add('fixed');
    showNotification('🔒 猫咪已固定');
  } else {
    cat.classList.remove('fixed');
    showNotification('🔓 猫咪已解锁');
  }
}

// 鼠标移动事件
document.addEventListener('mousemove', (e) => {
  if (!cat) return;
  
  // 只有在固定状态或显示提示框时才固定位置
  if (isFixed || isShowingTooltip) {
    cat.style.left = fixedPosition.x + 'px';
    cat.style.top = fixedPosition.y + 'px';
    
    if (tooltip.style.display === 'block') {
      tooltip.style.left = (fixedPosition.x + 60) + 'px';
      tooltip.style.top = fixedPosition.y + 'px';
    }
  } else {
    // 正常跟随鼠标
    const x = e.clientX + window.scrollX;
    const y = e.clientY + window.scrollY;
    
    cat.style.left = (x + 20) + 'px';
    cat.style.top = (y + 20) + 'px';
  }
});

// 文本选择事件
document.addEventListener('mouseup', async (e) => {
  setTimeout(async () => {
    const selectedText = window.getSelection().toString().trim();
    
    if (selectedText && /^[a-zA-Z\-']+$/.test(selectedText)) {
      currentWord = selectedText.toLowerCase();
      console.log('[猫咪插件] 选中单词:', currentWord);
      
      const x = e.clientX + window.scrollX;
      const y = e.clientY + window.scrollY;
      fixCatForTooltip(x + 20, y + 20);
      
      const translation = await getTranslation(currentWord);
      showTooltip(translation);
    } else {
      hideTooltip();
      unfixCatForTooltip();
      currentWord = '';
    }
  }, 100);
});

// 为显示提示框而固定猫咪
function fixCatForTooltip(x, y) {
  if (!isFixed) {
    isShowingTooltip = true;
    fixedPosition.x = x;
    fixedPosition.y = y;
    cat.style.left = fixedPosition.x + 'px';
    cat.style.top = fixedPosition.y + 'px';
    cat.classList.add('tooltip-fixed');
  }
}

// 隐藏提示框时解锁猫咪
function unfixCatForTooltip() {
  if (!isFixed) {
    isShowingTooltip = false;
    cat.classList.remove('tooltip-fixed');
  }
}

// 隐藏提示框 - 修复：确保状态重置
function hideTooltip() {
  if (tooltip) {
    tooltip.style.display = 'none';
  }
  unfixCatForTooltip(); // 重要：确保解锁猫咪
  currentWord = '';
}

// 点击其他地方隐藏提示框
document.addEventListener('mousedown', (e) => {
  if (!e.target.closest('#cat-tooltip') && !e.target.closest('#english-cat')) {
    setTimeout(() => {
      const selection = window.getSelection().toString().trim();
      if (!selection) {
        hideTooltip();
      }
    }, 50);
  }
});

// 按键事件
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    hideTooltip();
    window.getSelection().removeAllRanges();
  }
  
  if (e.code === 'Space' && e.ctrlKey) {
    e.preventDefault();
    toggleCatFixed({ 
      clientX: isFixed ? (fixedPosition.x - window.scrollX) : window.innerWidth / 2, 
      clientY: isFixed ? (fixedPosition.y - window.scrollY) : window.innerHeight / 2 
    });
  }
});

// 获取翻译和释义（使用 Free Dictionary API + Google Translate）
async function getTranslation(word) {
  try {
    console.log('[猫咪插件] 查询单词:', word);
    
    let chineseTranslation = '';
    let englishDefinitions = [];
    let phonetic = '';
    let audioUrl = '';
    let examples = [];
    
    // 步骤1: 使用 Free Dictionary API 获取英文释义
    try {
      const dictResponse = await fetch(`https://api.dictionaryapi.dev/api/v2/entries/en/${encodeURIComponent(word)}`);
      if (dictResponse.ok) {
        const dictData = await dictResponse.json();
        console.log('[猫咪插件] Free Dictionary API 返回:', dictData);
        
        if (dictData && dictData.length > 0) {
          const wordData = dictData[0];
          
          // 获取音标
          if (wordData.phonetics && wordData.phonetics.length > 0) {
            phonetic = wordData.phonetics.find(p => p.text)?.text || '';
            audioUrl = wordData.phonetics.find(p => p.audio)?.audio || '';
          }
          
          // 获取释义和例句
          if (wordData.meanings && wordData.meanings.length > 0) {
            wordData.meanings.forEach(meaning => {
              const partOfSpeech = meaning.partOfSpeech;
              
              if (meaning.definitions && meaning.definitions.length > 0) {
                meaning.definitions.slice(0, 2).forEach(def => {
                  englishDefinitions.push({
                    pos: partOfSpeech,
                    definition: def.definition,
                    example: def.example || ''
                  });
                  
                  if (def.example) {
                    examples.push(def.example);
                  }
                });
              }
            });
          }
        }
      }
    } catch (e) {
      console.log('[猫咪插件] Free Dictionary API失败:', e);
    }
    
    // 步骤2: 使用 Google Translate 获取中文翻译
    try {
      const translateResponse = await fetch(`https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=zh-CN&dt=t&q=${encodeURIComponent(word)}`);
      if (translateResponse.ok) {
        const translateData = await translateResponse.json();
        if (translateData[0] && translateData[0][0] && translateData[0][0][0]) {
          chineseTranslation = translateData[0][0][0];
        }
      }
    } catch (e) {
      console.log('[猫咪插件] Google Translate API失败:', e);
    }
    
    // 如果 Google Translate 失败，尝试备用翻译服务
    if (!chineseTranslation) {
      try {
        const response = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(word)}&langpair=en|zh-CN`);
        if (response.ok) {
          const data = await response.json();
          if (data.responseData && data.responseData.translatedText) {
            chineseTranslation = data.responseData.translatedText;
          }
        }
      } catch (e) {
        console.log('[猫咪插件] MyMemory API失败');
      }
    }
    
    // 返回完整数据
    return {
      word: word,
      chineseTranslation: chineseTranslation || '翻译服务暂时不可用',
      phonetic: phonetic,
      audioUrl: audioUrl,
      definitions: englishDefinitions,
      examples: examples.slice(0, 2)
    };
    
  } catch (error) {
    console.error('[猫咪插件] 查询错误:', error);
    return {
      word: word,
      chineseTranslation: '查询失败，请检查网络连接',
      phonetic: '',
      audioUrl: '',
      definitions: [],
      examples: []
    };
  }
}

// 显示提示框
function showTooltip(data) {
  if (!tooltip) return;
  
  // 构建释义HTML
  let definitionsHTML = '';
  if (data.definitions && data.definitions.length > 0) {
    definitionsHTML = data.definitions.map(def => `
      <div class="tooltip-definition-item">
        <span class="part-of-speech">${def.pos}</span>
        <span class="definition-text">${def.definition}</span>
      </div>
    `).join('');
  }
  
  // 构建例句HTML
  let examplesHTML = '';
  if (data.examples && data.examples.length > 0) {
    examplesHTML = data.examples.map(ex => `
      <div class="tooltip-example">📝 ${ex}</div>
    `).join('');
  }
  
  // 音标和发音按钮
  let phoneticHTML = '';
  if (data.phonetic) {
    phoneticHTML = `<span class="phonetic">${data.phonetic}</span>`;
  }
  if (data.audioUrl) {
    phoneticHTML += `<button class="audio-btn" data-audio="${data.audioUrl}" title="播放发音">🔊</button>`;
  }
  
  tooltip.innerHTML = `
    <div class="tooltip-content">
      <div class="tooltip-header">
        <div class="tooltip-word-section">
          <div class="tooltip-word">${data.word}</div>
          ${phoneticHTML ? `<div class="tooltip-phonetic">${phoneticHTML}</div>` : ''}
        </div>
        <div class="tooltip-actions">
          <button class="add-btn" title="添加到生词表">⭐</button>
          <button class="close-btn" title="关闭 (ESC)">✕</button>
        </div>
      </div>
      
      <div class="tooltip-chinese">
        <span class="chinese-label">中文释义</span>
        <span class="chinese-text">${data.chineseTranslation}</span>
      </div>
      
      ${definitionsHTML ? `<div class="tooltip-definitions">${definitionsHTML}</div>` : ''}
      
      ${examplesHTML}
      
      <div class="tooltip-hint">💡 右键点击猫咪添加到生词表 | 按ESC关闭</div>
    </div>
  `;
  
  tooltip.style.display = 'block';
  
  // 添加按钮事件
  const addBtn = tooltip.querySelector('.add-btn');
  if (addBtn) {
    addBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      addToVocabulary(currentWord);
      showNotification('✅ 已添加到生词表！');
    });
  }
  
  const closeBtn = tooltip.querySelector('.close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      hideTooltip(); // 使用 hideTooltip 函数确保状态重置
      window.getSelection().removeAllRanges();
    });
  }
  
  // 发音按钮事件
  const audioBtn = tooltip.querySelector('.audio-btn');
  if (audioBtn) {
    audioBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const audioUrl = e.target.getAttribute('data-audio');
      if (audioUrl) {
        const audio = new Audio(audioUrl);
        audio.play().catch(err => console.log('[猫咪插件] 音频播放失败:', err));
      }
    });
  }
}

// 添加到生词表
async function addToVocabulary(word) {
  const data = await getTranslation(word);
  
  chrome.storage.local.get(['vocabulary'], (result) => {
    const vocabulary = result.vocabulary || [];
    
    if (!vocabulary.find(item => item.word === word)) {
      vocabulary.push({
        word: data.word,
        chineseTranslation: data.chineseTranslation,
        phonetic: data.phonetic,
        definitions: data.definitions,
        examples: data.examples,
        addedAt: new Date().toISOString()
      });
      
      chrome.storage.local.set({ vocabulary }, () => {
        console.log('[猫咪插件] 单词已添加到生词表:', word);
      });
    } else {
      showNotification('ℹ️ 该单词已在生词表中');
    }
  });
}

// 显示通知
function showNotification(message) {
  const existingNotification = document.querySelector('.cat-notification');
  if (existingNotification) {
    existingNotification.remove();
  }
  
  const notification = document.createElement('div');
  notification.className = 'cat-notification';
  notification.textContent = message;
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.classList.add('show');
  }, 10);
  
  setTimeout(() => {
    notification.classList.remove('show');
    setTimeout(() => notification.remove(), 300);
  }, 2000);
}

// 初始化
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initCat);
} else {
  initCat();
}
