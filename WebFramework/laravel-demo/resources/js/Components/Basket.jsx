import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { useEffect, useState } from "react"
import { faTrash, faPlus, faMinus } from '@fortawesome/free-solid-svg-icons';

export default function Basket(props) {

    const [products, changeProducts] = useState([])

    useEffect(() => {
        if (sessionStorage.getItem("basket") === null) {
            sessionStorage.setItem("basket", JSON.stringify([]));
        }
        else {
            const productsBasket = JSON.parse(sessionStorage.getItem("basket"));
            changeProducts(productsBasket);
        }
    }, [])

    const clearBasket = () => {
        sessionStorage.setItem("basket", JSON.stringify([]));
        changeProducts([]);
        sessionStorage.removeItem("products");
        window.location.reload();
    }

    const changeQuantity = (id, quantity) => {

        let basket = JSON.parse(sessionStorage.getItem("basket"));

        const productInBasket = basket.find((product) => {
            return product.id == id;
        })

        if (productInBasket.quantity === -quantity) {
            removeProductFromBask(id);
            return;
        }
        productInBasket.quantity += quantity;

        const productsUpdated = JSON.parse(sessionStorage.getItem("products"));
        const product = productsUpdated.find((product) => {
            return product.id === id;
        });

        product.stockquantity += -quantity;

        sessionStorage.setItem("products", JSON.stringify(productsUpdated));
        sessionStorage.setItem("basket", JSON.stringify(basket));
        window.location.reload();
    }

    const removeProductFromBask = (id) => {

        let basket = JSON.parse(sessionStorage.getItem("basket"));

        const productInBasket = basket.find((product) => {
            return product.id == id;
        })

        const productsUpdated = JSON.parse(sessionStorage.getItem("products"));
        const product = productsUpdated.find((product) => {
            return product.id === id;
        });

        product.stockquantity += productInBasket.quantity;
        basket = basket.filter(function (product) {
            return product.id !== id;//remove product from basket
        })

        sessionStorage.setItem("products", JSON.stringify(productsUpdated));
        sessionStorage.setItem("basket", JSON.stringify(basket));
        window.location.reload();

    }

    const onBuy = () => {
        const headers = new Headers();
        headers.append("Content-type", "application/json");
        headers.append("X-CSRF-TOKEN", props.csrf_token)
        fetch("http://127.0.0.1:8000/buy", {
            method: "POST",
            headers: headers,
            body: JSON.stringify({ "basket": products })
        }).then((response) => {
            clearBasket();
        })
    }

    return (
        <div className="container">
            {products.map((product) => {
                return (
                    <div className="row" key={product.id}>
                        <div className="col">
                            {product.name}
                        </div>
                        <div className="col">
                            <FontAwesomeIcon icon={faMinus}
                                onClick={() => {
                                    changeQuantity(product.id, -1)
                                }}
                                className="plusminus click" />
                            {product.quantity}
                            <FontAwesomeIcon icon={faPlus}
                                className="plusminus click"
                                onClick={() => {
                                    changeQuantity(product.id, 1)
                                }}
                            />
                        </div>
                        <div className="col">
                            <a className="click" onClick={() => {
                                removeProductFromBask(product.id);
                            }}>
                                <FontAwesomeIcon icon={faTrash} />
                            </a>
                        </div>
                    </div>)
            })}
            <button
                className="btn btn-success"
                onClick={onBuy}
            >Buy</button>
            <button
                className="btn btn-danger"
                onClick={clearBasket}
            >Clear</button>
        </div>
    )

}