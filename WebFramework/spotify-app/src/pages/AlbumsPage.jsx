import { useState } from "react";
import Albums from "../components/Albums";
import ArtistSearch from "../components/ArtistSearch";
import { getArtists, getAlbumsByArtistId, getAlbums } from "../funct/Search";

export default function AlbumsPage({ token }) {

    const [artSrchVal, setArtSrchVal] = useState("");
    const [albumValue, setAlbVal] = useState("");
    const [albums, setAlbums] = useState([]);
    const [keyState, setKeyState] = useState(0);

    async function onArtistSearch() {
        const artists = await getArtists(artSrchVal, token);
        let albums = [];
        for (let i = 0; i < artists.length; i++) {
            albums = albums.concat((await getAlbumsByArtistId(artists[i].id)).items);
        }
        setAlbums(albums);
        setKeyState(keyState + 1);
    }

    async function onAlbumSearch() {
        const albumsSrch = await getAlbums(albumValue, token);
        setAlbums(albumsSrch.albums.items);
    }



    return (<div>
        <ArtistSearch setArtSrchVal={setArtSrchVal}
            onArtistSearch={onArtistSearch}></ArtistSearch>
        <div className="input-group">
            <div className="form-outline">
                <label htmlFor="albumSearch">Album:</label>
                <input type="search" id="albumSearch" className="form-control"
                    value={albumValue} onChange={(event) => {
                        setAlbVal(event.target.value);
                    }}
                />
            </div>
            <button type="button" className="btn" onClick={onAlbumSearch}>
                <i className="fas fa-search"></i>
            </button>
        </div>
        {albums.length !== 0 &&
            <Albums albums={albums} key={keyState}>
            </Albums>
        }
    </div>)
}