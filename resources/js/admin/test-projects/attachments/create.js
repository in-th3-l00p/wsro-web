document.querySelector("#file").onchange = (e) => {
    const name = document.querySelector("#name");
    if (name.value)
        return;
    const split = e.target.value.split("\\");
    const filename = split[split.length - 1];
    name.value = filename;
}
