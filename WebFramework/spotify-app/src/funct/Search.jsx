import { useNavigate } from "react-router-dom";

export async function getArtists(artistname, token, offset) {
    const headers = new Headers();
    headers.append("Authorization", "Bearer " + token);
    const artResp = await fetch("https://api.spotify.com/v1/search?limit=10&q=" + artistname + 
    "&type=artist&offset=" + offset, {
        method: "GET",
        headers: headers
    });
    const artBody = await artResp.json();
    const artists = artBody.artists;
    return artists;
}

// export async function getTotalArtists(artistname, token){
//     const headers = new Headers();
//     headers.append("Authorization", "Bearer " + token);
//     const artResp = await fetch("https://api.spotify.com/v1/search?q=" + artistname + "&type=artist", {
//         method: "GET",
//         headers: headers
//     });
//     const artBody = await artResp.json();
//     const artists = artBody.artists;
//     return artists.total;
// }

export async function getAlbumsByArtistId(artistId, token) {
    const headers = new Headers();
    headers.append("Authorization", "Bearer " + token);
    const response = await fetch("https://api.spotify.com/v1/artists/" + artistId + "/albums", {
        method: "GET",
        headers: headers
    });
    const albums = await response.json();
    return albums;
}

export async function getAlbums(albumname, token) {
    const headers = new Headers();
    headers.append("Authorization", "Bearer " + token);
    const albResp = await fetch("https://api.spotify.com/v1/search?q=" + albumname + "&type=album", {
        method: "GET",
        headers: headers
    });
    const albumsSrch = await albResp.json()
    return albumsSrch;
}