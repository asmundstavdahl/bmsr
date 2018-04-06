
let quickSelectElement = document.getElementById("quickSelect")

function findQuickSelectTargetElement() {
	return document.querySelector(`[data-quick-select='${quickSelect.innerHTML}']`)
}

let quickSelectCancel = e => {
	quickSelectElement.innerHTML = ""
}

hotkey(/^\d$/, e => {
	quickSelectElement.innerHTML += e.key
	if(!window.hotkeyCancelQueue.includes(quickSelectCancel)){
		window.hotkeyCancelQueue.push(quickSelectCancel)
	}
	
	let highlightedElements = document.getElementsByClassName("quick-select-highlight")
	for(let i = 0; i < highlightedElements.length; i++){
		highlightedElements[i].classList.remove("quick-select-highlight")
	}
	
	let el = findQuickSelectTargetElement()
	if(el) {
		el.classList.add("quick-select-highlight")
	}
})

hotkey("Enter", e => {
	let el = findQuickSelectTargetElement()
	if(el) {
		let child = el.querySelector("textarea, input, button")
		if(child){
			el = child
		}
		
		if(el.select) el.select()
		if(el.focus) el.focus()
		if(el.click) el.click()
	} else {
		quickSelectElement.innerHTML = ""
	}
})