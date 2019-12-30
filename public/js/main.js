/*
var clientId = '2ac7a537ba7141a59e78955306d46600';
var clientSecret = 'c6f16c9366e04c8098407b591d32c2ce';
*/

var Spotify = require('spotify-web-api-js');
var s = new Spotify();

accessToken = 'BQABaxBHf4iKIbpda07_dqIyKaflXV_XjHq2AzNyLdM5ZLjlsj55lXjcxGvV4M5aeXGjHEWZNvDWcQbLFvRnzZQV6nbb_VNSvkr5i8MFY-T3-L-n3HCxYVoGPJy1MKrXM4H2DZ35sqiBA1EZ3dlQH5OOZ_wzck8miQ'
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
                body: JSON.stringify(
                    {
                        artists: playlistArtists,
                        tracks: playlistTracks
                    })
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
















































































