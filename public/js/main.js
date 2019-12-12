/*
var clientId = '2ac7a537ba7141a59e78955306d46600';
var clientSecret = '82754758a34f4dd09f89440f88317c1d';
*/

var Spotify = require('spotify-web-api-js');
var s = new Spotify();

accessToken = 'BQCIzejk3XVc-t4jvFbP3MfaeRcQR8IAGawoIcZax8xWkU55W4MWgsJkOjwLzpw1YUdk1uMOCkLjbdLzQyp8j1vor8V9qgr4ViHOf162pkBYCwhkCjF8PJhoYVorHJ6mxzPD8c8ZQXaAgzo8SsgsluIT0XsAKSdn7g'
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
            var artists = JSON.stringify(playlistArtists);
            var tracks = JSON.stringify(playlistTracks);
            console.log(artists)


            fetch('http://localhost:8080/projects/playlist_generator%202/app/playlists.php', {
                method: 'POST',
                mode: 'cors',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: {
                    artists: artists,
                    tracks: tracks
                }
            })
                .then(res => res.text)
                .then(data => console.log(data))
                .catch(error => console.log(error))
        }

        else {
            saveErrorMsg.innerHTML = 'There is no playlist to save'
        }
    })
});



/*

//SAVE playlist: SEND PLAYLIST DATA TO PHP
function savePlaylist(artists, tracks) {
    console.log(artists)
    console.log(tracks)

}

*/







































































