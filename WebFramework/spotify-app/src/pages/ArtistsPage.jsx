import { useEffect, useState } from "react"
import Popup from 'reactjs-popup';
import Albums from "../components/Albums";
import ArtistSearch from "../components/ArtistSearch";
import Pagination from "../components/Pagination";
import { getArtists } from "../funct/Search";

export default function ArtistsPage({ token }) {

    const [artists, setArtists] = useState([]);
    const [searchVal, setSearchVal] = useState("");
    const [total, setTotal] = useState(0);

    function onSearch() {

        getArtists(searchVal, token, 0).then((artists) => {
            const artistItems = artists.items;
            setArtists(artistItems);
            setTotal(artists.total);
            // for (let i = 0; i < artistItems.length; i++) {
            //     setAlbums(artistItems[i].id)
            // }
        })
        // setArtists(artists);
        // setTotal(totalNo);
    }

    async function getAlbums(artistId) {
        const headers = new Headers();
        headers.append("Authorization", "Bearer " + token);
        const response = await fetch("https://api.spotify.com/v1/artists/" + artistId + "/albums", {
            method: "GET",
            headers: headers
        });
        const albums = await response.json();
        return albums;
    }

    const getTotalPages = () => {
        return Math.min(30, Math.ceil(total / 10));
    }

    const onNavPag = (pag) => {
        getArtists(searchVal, token, pag * 10).then((artists) => {
            const artistItems = artists.items;
            for (let i = 0; i < artistItems.length; i++) {
                artistItems.albums = [];
            }
            setArtists(artistItems);
        })
    }

    return (
        <div>
            <ArtistSearch setArtSrchVal={setSearchVal}
                onArtistSearch={onSearch}></ArtistSearch>

            {total > 0 &&
                <Pagination numberOfElements={getTotalPages()} onClick={onNavPag}></Pagination>}

            <div className="items-5-row">
                {artists.map((artist) => {
                    return (
                        <div className="card" key={artist.id}>
                            <img className="card-img-top" src={artist.images[0] === undefined ? "" :
                                artist.images[0].url}></img>
                            <div className="card-body">
                                <h5 className="card-title">{artist.name}</h5>
                                <p className="card-text">
                                    <b>Genres:</b>{artist.genres.map((genre) => {
                                        return genre + " ";
                                    })}
                                </p>

                                <h6>Followers : {artist.followers.total}</h6>
                                <Popup trigger={<button className="btn btn-dark">Albums</button>}
                                    position="right center">
                                    <Albums albums={artist.albums}></Albums>
                                </Popup>
                            </div>
                        </div>
                    )
                })}
            </div>
        </div>
    )
}