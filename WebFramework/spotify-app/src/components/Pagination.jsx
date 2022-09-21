export default function Pagination({ numberOfElements, onClick }) {

    const generateRows = () => {
        const rows = [];
        for (let i = 0; i < numberOfElements; i++) {
            rows.push(<li key={i} className="page-item"><button className="btn btn-light"
                onClick={() => { onClick(i) }}
            >{i + 1}</button></li>);
        }
        return rows;
    }

    return (
        <ul className="pagination">
            {generateRows().map((row) => {
                return row;
            })}
        </ul>
    )
}
