/***********************************************
 * Image Resize for Masonry Library
 * 
 * Author: Tomas Malio <tomasmalio@gmail.com>
 * Version: 1.0
 * Date: 2019-07-16
 ***********************************************/
function imageResize (width, height, target) {
	var percentage = '';
	if (width > height) {
		percentage = (target / width);
	} else {
		percentage = (target / height);
	}

	var widthSize = Math.round(width * percentage);
	var heightSize = Math.round(height * percentage);

	if (width < target) {
		var diff = target - widthSize;
		widthSize = widthSize + diff;
		heightSize = heightSize + diff;
	} else if (widthSize < target) {
		var diff = target - widthSize;
		widthSize = widthSize + diff;
		heightSize = heightSize + diff;
	}

	var array = new Object();
	array['width'] = widthSize;
	array['height'] = heightSize;
	return array;
}