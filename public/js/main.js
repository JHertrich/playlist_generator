/*
AUTHOR: JOHANNES HERTRICH
LATEST UPDATE: 01/07/2020
*/

//Integration of the spotify-web-api-js library from J-Perez
var Spotify = require('spotify-web-api-js');
var s = new Spotify();

//Spotify access token for API Requests
accessToken = 'BQCeUCvSLOagoOKx1LVdNPH01OvCIXROL6ExeIk5OjhjXRerDJK_1_FLTzf3CDwBh3nrpQ9pFSJFBNuKuM2vy-E1N2vTg-Tq8H4s9PY_UZ8OEVWkNsqRqDydltQkA2trH04g1_Q4skMRZLXVc7g6rg25Rmx-zk3tAw'
s.setAccessToken(accessToken);

//DOM ELEMENTS
var searchBtn = document.querySelector('.search-btn');
var searchValue = document.querySelector('.artist-input');
var newPlaylist = document.querySelector('.new-playlist');

var saveHere = document.querySelector('.save');
saveErrorMsg = document.querySelector('.save-error');


//GLOBAL VARIABLES
var countryId = 'US';
var playlistTracks = [];
var playlistArtists = [];


//HIDE SAVE-SECTION INITIALLY
$('.login-to-save').hide();
$('.save-section').hide();


//ARTIST SEARCH BUTTON CLICK EVENT -> HTTP REQUESTS TO SPOTIFY API ENDPOINTS
searchBtn.addEventListener('click', () => {
    var artist = searchValue.value;

    //GET THE CHOSEN ARTIST'S ID
    s.searchArtists(artist)
        .then(data =>
            data.artists.items[0].id)
        //Get the related artists' top track
        .then(artistId =>
            s.getArtistRelatedArtists(artistId))
        .then(data =>
            data.artists.map(a => a.id))
        .then(artistsIds => {
            artistsIds.forEach((artistId) => {
                s.getArtistTopTracks(artistId, countryId)
                    .then(tracksInfo => {
                        let trackArtists = tracksInfo.tracks.map(a => a.artists.map(b => b.name)).slice(0, 1);
                        let trackNames = tracksInfo.tracks.map(a => a.name).slice(0, 1);
                        let li = document.createElement('li');
                        trackArtists.flat(2);
                        trackNames.flat(2);

                        li.innerHTML = trackArtists + ' - ' + trackNames;
                        newPlaylist.append(li)

                        playlistArtists.push(trackArtists.flat());
                        playlistTracks.push(trackNames);

                    })
            })
        })
        .catch(error => console.error(error));

    //SAVE SECTION FADE IN
    $('.login-to-save').fadeIn('slow');
    if (userId) {
        $('.save-section').fadeIn('slow');
        $('.login-to-save').css("display", "none");
    }

    /*SAVE HERE (SAVE PLAYLIST IN DATABASE) CLICK EVENT
    -> USING FETCH (POST METHOD) TO SEND PLAYLIST DATA TO playlistData.php*/
    saveHere.addEventListener('click', () => {

        if (newPlaylist.hasChildNodes) {

            //NAMING THE PLAYLIST
            var popup = prompt("Please enter the name of your playlist");

            //SEND PLAYLIST DATA TO PHP
            if (popup != null) {
                fetch('http://localhost:8080/projects/playlist_generator%202/app/playlistData.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(
                        {
                            artists: playlistArtists,
                            tracks: playlistTracks,
                            name: popup,
                            user: userId
                        })
                })
                    .then(res => res.text())
                    .then(data => console.log(data))
                    .catch(error => console.log(error.message))
            }
        }
        else {
            saveErrorMsg.innerHTML = 'There is no playlist to save';
        }
    })
})























































































