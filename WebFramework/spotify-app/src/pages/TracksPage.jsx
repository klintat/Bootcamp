import { useState } from "react"
import Tracks from "../components/Tracks";

export default function TracksPage({ token }) {

    const [tracks, setTracks] = useState([]);
    const [trackSrchVal, setTracksSrchVal] = useState("");
    const [stateKey, setStKey] = useState(0);

    async function searchByTrack() {
        const headers = new Headers();
        headers.append("Authorization", "Bearer " + token);
        const trackResp = await fetch("https://api.spotify.com/v1/search?q=" + trackSrchVal + "&type=track", {
            method: "GET",
            headers: headers
        });
        const trackSrch = await trackResp.json()
        setTracks(trackSrch.tracks.items);
        setStKey(stateKey + 1);
    }

    return (<div>
        <div className="input-group">
            <div className="form-outline">
                <input type="search" id="trackSearch" className="form-control"
                    value={trackSrchVal} onChange={(event) => {
                        setTracksSrchVal(event.target.value)
                    }}
                />
            </div>
            <button type="button" className="btn" onClick={searchByTrack}>
                <i className="fas fa-search"></i>
            </button>
        </div>
        {tracks.length > 0 &&
            <Tracks tracks={tracks} key={stateKey}></Tracks>
        }

    </div>
    )
}