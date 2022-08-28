function copyThis(text){
    // navigator.clipboard.writeText(text);
    navigator.clipboard.readText().then(
        (clipText) => text);
}