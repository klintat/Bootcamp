export default function ProductButton({ productId, addProduct }) {

    return (
        <button onClick={() => { addProduct(productId) }}
            className="btn btn-dark">
            Add
        </button>)

}