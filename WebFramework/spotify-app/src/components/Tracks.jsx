export default function Tracks({ tracks }) {

    return (<div>
   <div className="items-5-row">
            {tracks.map((track) => {
                return (
                    <div className="card" key={track.id}>
                        <img className="card-img-top" src={track.album.images[0] === undefined ? "" :
                            track.album.images[0].url}></img>
                        <div className="card-body">
                            <h5 className="card-title">{track.name}</h5>
                            <ul className="list-group list-group-flush">
                                <li className="list-group-item"><b>Release date:</b> {track.album.release_date}</li>
                                {track.artists.map((artist) => {
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