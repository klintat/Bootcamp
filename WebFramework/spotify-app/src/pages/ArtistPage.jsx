import { useEffect, useState } from "react"

export default function ArtistsPage() {

    const [artists, setArtists] = useState([]);
    const [token, setToken] = useState("");
    const [searchVal, setSearchVal] = useState("");

    useEffect(() => {
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        setToken(params.get("token"));
    })

    const onSearch = () => {
        const headers = new Headers();
        headers.append("Authorization", "Bearer " + token);
        fetch("https://api.spotify.com/v1/search?q=" + searchVal + "&type=artist", {
            method: "GET",
            headers: headers
        }).then((response) => {
            response.json().then((body) => {
                setArtists(body.artists.items);
            })
        })
    }

    const onChangeSearchVal = (event) => {
        const searchVal = event.target.value;
        setSearchVal(searchVal);
    }

    return (
        <div>
            <div className="input-group">
                <div className="form-outline">
                    <input type="search" id="artistSearch" className="form-control"
                        value={searchVal} onChange={(event) => {
                            onChangeSearchVal(event);
                        }}
                    />
                </div>
                <button type="button" className="btn" onClick={onSearch}>
                    <i className="fas fa-search"></i>
                </button>
            </div>
            <div className="items-5-row">
                {artists.map((artist) => {
                    return (
                        <div className="card" key={artist.id}>
                            <img className="card-img-top" src={artist.images[2] === undefined ? "" :
                                artist.images[2].url}></img>
                            <div className="card-body">
                                <h5 className="card-title">{artist.name}</h5>
                                <p className="card-text">
                                    <b>Genres:</b>{artist.genres.map((genre) => {
                                        return genre + " ";
                                    })}
                                </p>

                                <h6>Followers : {artist.followers.total}</h6>
                            </div>
                        </div>
                    )
                })}
            </div>
        </div>
    )
}