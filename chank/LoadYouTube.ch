/*
 ����=youtube��javascript �擾 
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
    console.log('MovieTime ='+ event.target.getDuration() +'(sec)' ); /* �������OK�@�f�o�b�O�R���\�[���ɂ͕\������� */
�@  event.target.getIframe().parentElement.parentElement.textContent�@= 'MovieTime ='+ event.target.getDuration() +'(sec)' ;
/*  ��U�ADOM��IFlame�v�f�ɖ߂��Ă���A�N�Z�X�{���s�̒��g(youtube�̃t���[�����̂���)�͎c���Ȃ��ƁA�\����������� */
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
//  document.getElementById('dbgmsg').textContent='�񂬂�[�B�f�o�b�N���b�Z�[�W����\���ł���Ƃ��H';
  console.log('�f�o�b�N���b�Z�[�W�\��');
}
</script>
