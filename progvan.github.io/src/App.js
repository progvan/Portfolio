import React from "react";
import Header from "./components/Header";
import Footer from "./components/Footer";
import Items from "./components/Items";
import Categories from "./components/Categories";
import ShowFullItem from "./components/ShowFullItem";

class App extends React.Component{
  constructor(props){
    super(props)
    this.state = {
      orders: [],
      currentItems: [],
      items: [
        {
          id: 1,
          title: "Стул сірий",
          img: "ingolf-chair-gray__0622804_pe690773_s5.avif",
          desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ullam nam incidunt commodi, praesentium neque non, odit, saepe quae expedita debitis similique dolorum. Iste at sunt molestias veniam velit repudiandae.",
          category: "chairs",
          price: '50.99'
        },
        {
          id: 2,
          title: "Стул чорний",
          img: "1100383_0_1000x1000.jpg",
          desc: "Lorem ipsum sit amet consectetur adipisicing elit. Totam ullam nam incidunt commodi, praesentium neque non, odit, saepe quae expedita debitis similique dolorum. Iste at sunt molestias veniam velit repudiandae.",
          category: "chairs",
          price: '50.99'
        },
        {
          id: 3,
          title: "Стол чорний",
          img: "lisabo-table-black__0737106_pe740884_s5.avif",
          desc: "Lorem sit amet consectetur adipisicing elit. Totam ullam nam incidunt commodi, praesentium neque non, odit, saepe quae expedita debitis similique dolorum. Iste at sunt molestias veniam velit repudiandae.",
          category: "tables",
          price: '80.99'
        },
        {
          id: 4,
          title: "Ліжко біле",
          img: "e69e46ca-7081-4b45-b2e5-7748b778e838.jpg",
          desc: "Totam ullam nam praesentium neque non, odit, saepe quae expedita debitis similique dolorum. Iste at sunt molestias veniam velit repudiandae.",
          category: "beds",
          price: '100.99'
        }
      ],
      showFullItem: false,
      fullItem: {}
    }
    this.state.currentItems = this.state.items
    this.addToOrder = this.addToOrder.bind(this)
    this.deleteOrder = this.deleteOrder.bind(this)
    this.chooseCategory = this.chooseCategory.bind(this)
    this.onShowItem = this.onShowItem.bind(this)  
  }

  render(){
    return (
      <div className="wrapper">
        <Header orders={this.state.orders} onDelete={this.deleteOrder} />
        <Categories chooseCategory={this.chooseCategory} />
        <Items onShowItem={this.onShowItem} items={this.state.currentItems} onAdd={this.addToOrder} />
        
        {this.state.showFullItem && <ShowFullItem onShowItem={this.onShowItem} onAdd={this.addToOrder} item={this.state.fullItem} />}
        <Footer />
      </div> 
    );
  }

  onShowItem(item) {
    this.setState({fullItem: item})
    this.setState({showFullItem: !this.state.showFullItem})
  }

  deleteOrder(id){
    this.setState({orders: this.state.orders.filter(el => el.id !== id)})
  }

  chooseCategory(category){
    if(category === 'all'){
      this.setState({currentItems: this.state.items})
      return
    }

    this.setState({
      currentItems: this.state.items.filter(el => el.category === category)
    })
  }

  addToOrder(item){
    let isInArray = false;
    this.state.orders.forEach(el => {
      if(el.id === item.id)
      isInArray = true
    })
    if(!isInArray)
      this.setState({orders: [...this.state.orders, item]})
  }
}

export default App;
