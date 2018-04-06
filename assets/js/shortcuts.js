/**
 * Productivity enhancing shortcuts
 */

document.body.addEventListener("keypress", function(e) {
    console.log("key:" + e.key, e)
    
    let hotkeyId = e.key
    
    if (e.altKey && e.key != "Alt"){
        hotkeyId = "Alt+" + hotkeyId
    }
    if (e.ctrlKey && e.key != "Control"){
        hotkeyId = "Ctrl+" + hotkeyId
    }
    if (e.shiftKey && e.key != "Shift"){
        hotkeyId = "Shift+" + hotkeyId
    }

    hotkeyId = "hotkey_" + hotkeyId.toLowerCase()

    console.log(window[hotkeyId])
    if(typeof window[hotkeyId] === "function"){
        window[hotkeyId](e)
    } else {
        console.warn("No callable hotkey registered for " + hotkeyId)
    }
})
