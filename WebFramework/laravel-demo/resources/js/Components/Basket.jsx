import { useEffect, useState } from "react"

export default function Basket(){

    const [products, changeProducts] = useState([]);
    useEffect(() => {
        if (sessionStorage.getItem("basket") === null) {
            sessionStorage.getItem("basket", JSON.stringify([]));
        }
        else if (products === []) {
            const productsBasket = JSON.parse(sessionStorage.getItem("basket"));
            changeProducts(productsBasket);
        }
    })

    return (
        <div className="container">
            {products.map((product) => {
                
            })}
        </div>
    )
}