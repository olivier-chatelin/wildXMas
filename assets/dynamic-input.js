const title = document.getElementById('reward_title');
const rewardTitle = document.getElementById('reward-title');
const url = document.getElementById('reward_url');
const rewardImg = document.getElementById('reward-img');
const isGood = document.getElementById('reward_isGood');
const goodTag = document.getElementById('goodTag');
const isRemoteFriendly = document.getElementById('reward_isRemoteFriendly');
const remoteTag = document.getElementById('remoteTag');
const isFrench = document.getElementById('reward_isFrench');
const languageTag = document.getElementById('languageTag');

title.addEventListener('change',(e)=>{
    rewardTitle.innerHTML = e.target.value;
    console.log(title.value);
})
url.addEventListener('change',(e)=>{
    rewardImg.style.backgroundImage = `url(${e.target.value})`;
})
isGood.addEventListener('change',(e)=>{
    goodTag.classList.toggle('goodTag');
    goodTag.classList.toggle('evilTag');
})
isRemoteFriendly.addEventListener('change',(e)=>{
    remoteTag.classList.toggle('remoteTag');
    remoteTag.classList.toggle('presenceTag');
})
isFrench.addEventListener('change',(e)=>{
    languageTag.classList.toggle('frenchTag');
    languageTag.classList.toggle('englishTag');
})
