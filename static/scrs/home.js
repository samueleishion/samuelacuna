$(document).ready(function() {
  var bgimgs = [
    '../imgs/bg/california1_bw_sm.jpg',
    '../imgs/bg/california2_bw_sm.jpg',
    '../imgs/bg/california3_bw_sm.jpg',
    '../imgs/bg/california4_bw_sm.jpg',
    '../imgs/bg/california5_bw_sm.jpg',
    '../imgs/bg/california6_bw_sm.jpg',
    '../imgs/bg/newmexico3_bw_sm.jpg',
    '../imgs/bg/texas_bw_sm.jpg',
    '../imgs/bg/utah_bw_sm.jpg'
  ];

  var getBgimg = function() {
    var index = Math.round(Math.random() * (bgimgs.length - 1));
    var img = bgimgs[index];
    console.log("getBgimg", index, img, bgimgs.length);
    return 'url("' + img + '")';
  };

  var img = getBgimg();

  console.log(img);
  $('body').attr('style', 'background-image:' + img);
});
