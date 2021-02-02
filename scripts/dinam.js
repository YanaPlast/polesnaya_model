const parent_original = document.querySelector('.five-reasons-slider');
const parent = document.querySelector('#five_reasons .inner');
const item = document.querySelector('.comparing');
const mediaQuery = window.matchMedia('(max-width: 900px)');


function handleTabletChange(e) {
	if (e.matches) {
		if (!item.classList.contains('done')){
					parent.insertBefore(item, parent.children[2]);
					item.classList.add('done');
					}
				} else {
					if(item.classList.contains('done')){
						parent_original.insertBefore(item, parent_original.children[2]);
						item.classList.remove('done');
					}
	}
}
mediaQuery.addListener(handleTabletChange);
handleTabletChange(mediaQuery);






/*	if (mediaQuery.matches) {

		if (!item.classList.contains('done')){
			parent.insertBefore(item, parent.children[2]);
			item.classList.add('done');
			}
		} else {
			if(item.classList.contains('done')){
				parent_original.insertBefore(item, parent_original.children[2]);
				item.classList.remove('done');
			}
	}
*/



/*

const parent_original = document.querySelector('.five-reasons-slider');
const parent = document.querySelector('#five_reasons .inner');
const item = document.querySelector('.comparing');

window.addEventListener('resize', function(event){
	const viewport_width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
	if (viewport_width < 778) {
		if (!item.classList.contains('done')){
			parent.insertBefore(item, parent.children[2]);
			item.classList.add('done');
			}
		} else {
			if(item.classList.contains('done')){
				parent_original.insertBefore(item, parent_original.children[2]);
				item.classList.remove('done');
			}
		}
});

============================= рабочий нединамический - если открыть с телефона, но на изменение размера окна не реагирует.  

if (mediaQuery.matches) {

	if (!item.classList.contains('done')){
		parent.insertBefore(item, parent.children[2]);
		item.classList.add('done');
		}
	} else {
		if(item.classList.contains('done')){
			parent_original.insertBefore(item, parent_original.children[2]);
			item.classList.remove('done');
		}
}

.matches
 идеально подходит для одноразовых мгновенных проверок, но не может постоянно проверять наличие изменений. Значит, нам нужно…
Прослушивать изменения

*/