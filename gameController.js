// variables
let responseJson;
var gifQueries;

let cookies = document.cookie.split(';').map(cookie => cookie.split('='))
    .reduce((accumulator, [key, value]) =>
        ({ ...accumulator, [key.trim()]: decodeURIComponent(value) }), {});

var lvl = cookies.lvl ? cookies.lvl : 1; // set level to 1 if never played

// url Async requesting function
function httpGetAsync(interfaceElementId, theUrl, tenorCallback_search)
{
    // create the request object
    var xmlHttp = new XMLHttpRequest();

    // set the state change callback to capture when the response comes in
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            tenorCallback_search(xmlHttp.responseText, interfaceElementId);
        }
    }

    // open as a GET call, pass in the url and set async = True
    xmlHttp.open("GET", theUrl, true);

    // call send with no params as they were passed in on the url string
    xmlHttp.send(null);

    return;
}

// callback for the top GIFs of search
function tenorCallback_search(response, interfaceElementId)
{
    // parse the json response
    let response_objects = JSON.parse(response);
    let gifs = response_objects["results"];

    // load the GIFs to UI element
    document.getElementById(interfaceElementId.toString()).src = gifs[0]["media"][0]["tinygif"]["url"];

    return;

}

// function to call tenor
function grab_data(search_term, interfaceElementId)
{
    // set the API_KEY and limit
    const API_KEY = "6POKIN1S0L9I";
    const LIMIT = 50;
    let pos = Math.floor(Math.random() * LIMIT); // get random gif

    // using default locale of en_US
    let search_url = "https://g.tenor.com/v1/search?q=" + search_term + "&key=" +
        API_KEY + "&limit=" + LIMIT + "&pos=" + pos;

    httpGetAsync(interfaceElementId, search_url, tenorCallback_search);

    // data will be loaded by each call's callback
    return;
}

function levelUp()
{
    lvl++;
    updateLevelDisplay();
    updateCookie()
    extractLevelDataFromJson()
}

function updateLevelDisplay() {
    document.getElementById("lvl-disp").innerText = "Level " + lvl;
}

function submitGuess()
{
    let answer = responseJson[lvl - 1]["answer"];
    let guessInput = document.getElementById("guess-input")
    let guess = input.value;

    if (guess.toLowerCase().replace(/\s/g, '') === answer.replace(/\s/g, '')) {
        // execute on animation end
        guessInput.addEventListener("animationend", function() {
            guessInput.classList.remove("bounce-anim"); // remove class for future animations to work
            displayDefinitionModal();
            guessInput.value = '';
        });

        // animate
        guessInput.className = "bounce-anim";


    } else {
        guessInput.animate([
            // keyframes
            {color: 'red' },
            {color: 'black' }
        ], {
            // timing options
            duration: 2000,
            iterations: 1
        });
    }
}

function updateCookie() {
    document.cookie = "lvl=" + lvl;

    // expiration date
    var now = new Date();
    now.setMonth( now.getMonth() + 3 );
    document.cookie = ";expires=" + now.toUTCString() + ";"
}

// get JSON containing level data
function getLevelDataJson() {
    fetch("resources/levels.json")
        .then(response => {
            return response.json();
        })
        .then(data => {
            responseJson = data;
            extractLevelDataFromJson();
        });
}

// update UI elements with data
function extractLevelDataFromJson() {
    // level data
    gifQueries = responseJson[lvl - 1]["searches"];

    // change displayed data
    for (let i = 1; i <= gifQueries.length; i++)
    {
        grab_data(gifQueries[i - 1], "gif" + i)
    }
}

function switchGif(interfaceGifId) {
    // level data
    gifQueries = responseJson[lvl - 1]["searches"];

    // change gif of corresponding element
    grab_data(gifQueries[interfaceGifId - 1], "gif" + interfaceGifId)
}

/* modal controller */
function displayDefinitionModal() {
    let answer = responseJson[lvl - 1]["answer"];
    let definition = responseJson[lvl - 1]["definition"];

    // make first letter uppercase
    answer = answer.charAt(0).toUpperCase() + answer.slice(1);

    document.getElementById("mot").innerText = answer;
    document.getElementById("definition").innerText = definition;

    // add window event listener to close modal when user clicks outside of window
/*
    let windowClickHandler = function(event) {
        // remove window event listener
        this.removeEventListener('click', windowClickHandler);

        closeDefinitionModal();
    }

    window.addEventListener('click', windowClickHandler);
*/

    // show modal
    document.getElementById("definition-modal").style.display = "block";
}

function closeDefinitionModal() {
    // hide modal
    document.getElementById("definition-modal").style.display = "none";

    // go to next level once modal is closed
    levelUp();
}

/* Main */
function main() {
    updateLevelDisplay();
    getLevelDataJson();
}
