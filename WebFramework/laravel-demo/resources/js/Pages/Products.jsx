import Authenticated from "@/Layouts/Authenticated";


export default function Products(props) {

    const products = props.products;

    return (
        <div className="container">
            <Authenticated
                auth={props.auth}
                errors={props.errors}
                header={""}
            >
                <div class="row">
                    {products.map((product) => {
                        return (<div className="col">
                            <div className="card">
                                <div className="card-body">
                                    <h5 className="card-title">{product.name}</h5>
                                    <p className="card-text">
                                        Product descrition</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                    <h6>Quantity : {product.stockquantity}</h6>
                                </div>
                            </div>
                        </div>);
                    })}
                </div>
            </Authenticated>
        </div>
    )

}