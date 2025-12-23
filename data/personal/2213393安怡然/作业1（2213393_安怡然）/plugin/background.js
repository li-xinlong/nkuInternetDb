// 安装时初始化
chrome.runtime.onInstalled.addListener(() => {
  console.log('英语学习猫咪助手已安装');
  
  // 初始化存储
  chrome.storage.local.get(['vocabulary'], (result) => {
    if (!result.vocabulary) {
      chrome.storage.local.set({ vocabulary: [] });
    }
  });
});

// 监听来自content script的消息
chrome.runtime.onMessage.addListener((request, sender, sendResponse) => {
  if (request.action === 'addWord') {
    chrome.storage.local.get(['vocabulary'], (result) => {
      const vocabulary = result.vocabulary || [];
      vocabulary.push(request.word);
      chrome.storage.local.set({ vocabulary });
      sendResponse({ success: true });
    });
    return true;
  }
});
