/*
 準備=youtubeのjavascript 取得 
*/
<script src="https://www.youtube.com/iframe_api"></script>
<script>
let multiPlaers;
let doYTplayer = function (containerID, movieID) {
    multiPlaers = new YT.Player(containerID, {
      height: '431',
      width: '784',
      videoId: movieID,
      events: {'onReady': onPlayerReady }, playerVars: { 'loop': 0,'playlist': movieID } });
}
function onPlayerReady(event) {
    event.target.setVolume(0);
    console.log('MovieTime ='+ event.target.getDuration() +'(sec)' ); /* こちらはOK　デバッグコンソールには表示される */
　  event.target.getIframe().parentElement.parentElement.textContent　= 'MovieTime ='+ event.target.getDuration() +'(sec)' ;
/*  一旦、DOMのIFlame要素に戻してからアクセス＋現行の中身(youtubeのフレームそのもの)は残さないと、表示がくずれる */
}
function onYouTubeIframeAPIReady() {
    let ytContainers = document.querySelectorAll('.yt-container');
    let containerID, movieID;
    for (const singleContainer of ytContainers) {
        containerID = singleContainer.id;
        movieID = singleContainer.dataset.movid;
        doYTplayer(containerID, movieID);
    }
}
window.onload = function(){ 
  onYouTubeIframeAPIReady();
//  document.getElementById('dbgmsg').textContent='んぎゃー。デバックメッセージすら表示できんとか？';
  console.log('デバックメッセージ表示');
}
</script>
