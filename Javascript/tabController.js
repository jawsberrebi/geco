function changeTab(tabId, tabName) {
    var tabs = document.getElementsByClassName("tab");
    var tabViews = document.getElementsByClassName("tab-view");

    for (let i = 0; i < tabViews.length; i++) {
        // changer de vue
        tabViews[i].style.display = "none";

        // modifier la couleur de l'onglet sélectionné


        if (tabs[i].id == tabId) {
            if (!tabs[i].classList.contains("active")) {
                tabs[i].classList.add("active");
            }
        } else {
            tabs[i].classList.remove("active");
        }
    }

    document.getElementById(tabName).style.display = "block";
}
