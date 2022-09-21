export default function ArtistSearch({ setArtSrchVal, onArtistSearch }) {
    return (<div className="input-group">
        <div className="form-outline">
            <label htmlFor="artistSearch">Artist:</label>
            <input type="search" id="artistSearch" className="form-control"
                onChange={(event) => {
                    setArtSrchVal(event.target.value);
                }}
            />
        </div>

        <button type="button" className="btn" onClick={onArtistSearch}>
            <i className="fas fa-search"></i>
        </button>

    </div>)
}