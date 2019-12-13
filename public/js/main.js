/*
var clientId = '2ac7a537ba7141a59e78955306d46600';
var clientSecret = '82754758a34f4dd09f89440f88317c1d';
*/

var Spotify = require('spotify-web-api-js');
var s = new Spotify();

accessToken = 'BQBncFzp3a7QNTdEQ1iR2KKbMx1zcWLELSz3qQ2s2g9-P-GjB_owSLqHw3UhXvB40LiO9Wj6zzorwJhCyBSlFflwxHbvr43TP54eCSRkiOvx9AaBp1IX8HNJdMsnY-EhgpUu7Vyw62Vl_xPLVKBzQX-3RMr1cUqW8w'
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
$('.save-section').hide();

//SEARCH BUTTON CLICK EVENT
searchBtn.addEventListener('click', () => {
    //ev.preventDefault();
    //newPlaylist.innerHTML = '';
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
    $('.save-section').fadeIn('slow');


    //save here button click event
    saveHere.addEventListener('click', () => {
        if (newPlaylist.hasChildNodes) {


            fetch('http://localhost:8080/projects/playlist_generator%202/app/playlists.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ artist: 'artist' }),


            })
                .then(res => res.text())
                .then(data => console.log(data))
                .catch(error => console.log(error.message))

        }


        else {
            saveErrorMsg.innerHTML = 'There is no playlist to save'
        }
    })
});











































































