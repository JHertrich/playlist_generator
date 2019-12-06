/*
var clientId = '2ac7a537ba7141a59e78955306d46600';
var clientSecret = '82754758a34f4dd09f89440f88317c1d';
*/

var Spotify = require('spotify-web-api-js');
var s = new Spotify();

accessToken = 'BQDMW7XLeb3t0UUdcFFcUfKZYamgPQuzMubzPc7EmCZGwc7qQFUAZqvYwWIf9OhmMYHzQr4yP0JE9ioXJioI7qsN86hjfKq6Tuy3ae1OcY7kdMzEkOtXWFBQnQ3yqDrnKXKE2U60w9u5e4AIkEQiSpDkVlJzp5DMJw'
s.setAccessToken(accessToken);

//DOM ELEMENTS
var searchForm = document.querySelector('.artist-selection');
var searchValue = document.querySelector('.artist-input');
var newPlaylist = document.querySelector('.new-playlist');
var searchBtn = document.querySelector('.search-btn');

//GLOBAL VARIABLES
var countryId = 'US';
var playlistTracks = [];
var playlistArtists = [];

playlistArtistsNew = [];
playlistTracksNew = [];

//HIDE SAVE-SECTION INITIALLY
$('.save-section').hide();

//SEARCH BUTTON CLICK EVENT
searchBtn.addEventListener('click', () => {
    //ev.preventDefault();
    //newPlaylist.innerHTML = '';
    var artist = searchValue.value;


    //Get the chosen artist's top track
    s.searchArtists(artist)
        .then(function (data) {
            return data.artists.items[0].id;
        })
        .then(function (artistId) {
            return s.getArtistTopTracks(artistId, countryId);
        })
        .then(function (tracksInfo) {
            let trackArtists = tracksInfo.tracks.map(function (t) { return t.artists.map(function (a) { return a.name }) }).slice(0, 1);
            let trackNames = tracksInfo.tracks.map(function (t) { return t.name }).slice(0, 1);
            playlistArtists.push(trackArtists);
            playlistTracks.push(trackNames);
        })
        .catch(function (error) {
            console.error(error);
        });


    //Get the related artists' top tracks
    s.searchArtists(artist)
        .then(function (data) {
            return data.artists.items[0].id;
        })
        .then(function (artistId) {
            return s.getArtistRelatedArtists(artistId);
        })
        .then(function (data) {
            return data.artists.map(function (a) { return a.id; });
        })
        .then(function (artistsIds) {
            artistsIds.forEach((artistId) => {
                s.getArtistTopTracks(artistId, countryId)
                    .then(function (tracksInfo) {
                        let trackArtists = tracksInfo.tracks.map(function (t) { return t.artists.map(function (a) { return a.name }) }).slice(0, 1);
                        let trackNames = tracksInfo.tracks.map(function (t) { return t.name; }).slice(0, 1);
                        playlistArtists.push(trackArtists);
                        playlistTracks.push(trackNames);
                    })
            })
        })
        .catch(function (error) {
            console.error(error);
        });
    displayResults(playlistArtists, playlistTracks);
});




function displayResults(playlistArtists, playlistTracks) {
    playlistArtists.forEach((a) => a.forEach((b) => playlistArtistsNew.push(b[0])));
    playlistTracks.map((a) => { return a.map((b) => { return playlistTracksNew.push(b) }) });
    console.log(playlistTracksNew)




    //COMBINE TRACKS AND ARTISTS ARRAYS INTO ONE PLAYLIST ARRAY
    var playlist = playlistTracksNew.map((e, i) => e + ', ' + playlistArtistsNew[i]);




    //LOOP THROUGH THE PLAYLIST AND INSERT TRACKS AND CORRESPONDING ARTISTS IN THE DOM
    //playlist.forEach((a) => console.log(a));


    playlist.forEach((a) => {
        let li = document.createElement('li');
        li.innerHTML = a;
        newPlaylist.append(li)

    })


    //SAVE SECTION FADE IN
    $('.save-section').fadeIn('slow');


}






























/*
   var queryName = artist.split(' ').join('%20');
   var query = 'q=' + queryName + '&type=artist'; */
























