export default function Albums({ albums }) {

    return (<div>
        <div className="items-5-row">
            {albums.map((album) => {
                return (
                    <div className="card" key={album.id}>
                        <img className="card-img-top" src={album.images[0] === undefined ? "" :
                            album.images[0].url}></img>
                        <div className="card-body">
                            <h5 className="card-title">{album.name}</h5>
                            <ul className="list-group list-group-flush">
                                <li className="list-group-item"
                                ><b>Release date:</b> {album.release_date}</li>
                                <li className="list-group-item"><b>Total tracks:</b>{album.total_tracks}</li>
                                {album.artists.map((artist) => {
                                    return <li className="list-group-item"><b>Artist:</b>{artist.name}</li>
                                })}
                            </ul>
                        </div>
                    </div>
                )
            })}
        </div>
    </div>)
}