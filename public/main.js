/*
var clientId = '2ac7a537ba7141a59e78955306d46600';
var clientSecret = '82754758a34f4dd09f89440f88317c1d';
*/

var Spotify = require('spotify-web-api-js');
var s = new Spotify();

accessToken = 'BQBuAtE5-FWndEH1l_lqRxcffE8U1_ak-QfSGiT9TyZqu3V2cD17BCuc4vnjIJWGaJcQOXRi9simIAd6xKz2p9GkE4ku9mXxixEO82YFEWUxeo5qdtYZ-iiopr4D-6QlYbwGHxxhdQRR1DdVZVupsyijWDhunmpYTQ'
s.setAccessToken(accessToken);

//DOM ELEMENTS
var searchForm = document.querySelector('.artist-selection');
var searchValue = document.querySelector('.artist-input');
var newPlaylist = document.querySelector('.new-playlist');

//GLOBAL VARIABLES
var countryId = 'US';
var playlistTracks = [];
var playlistArtists = [];

//Search Button Event
searchForm.addEventListener('submit', (ev) => {
    ev.preventDefault();
    newPlaylist.innerHTML = '';
    var artist = searchValue.value;




    //Get the artist's two top tracks
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


    //Get the related artists' top two tracks
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

    playlistArtistsNew = [];
    playlistTracksNew = [];

    playlistArtists.forEach((a) => a.forEach((b) => playlistArtistsNew.push(b[0])));
    playlistTracks.forEach((a) => a.forEach((b) => playlistTracksNew.push(b)));

    var playlist = playlistTracksNew.map((e, i) => e + ', ' + playlistArtistsNew[i]);


    playlist.forEach((a) => {
        let li = document.createElement('li');
        li.innerHTML = a;
        newPlaylist.append(li)
    })

});






















/*
   var queryName = artist.split(' ').join('%20');
   var query = 'q=' + queryName + '&type=artist'; */
























