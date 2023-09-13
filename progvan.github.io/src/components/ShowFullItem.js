import React, { Component } from 'react'

export class ShowFullItem extends Component {
  render() {
    return (
      <div className='full_item'>
        <div>
            <img src={"./images/" + this.props.item.img} onClick={() => this.props.onShowItem(this.props.item)}/>
            <h2>{this.props.item.title}</h2>
            <p>{this.props.item.desc}</p>
            <b>{this.props.item.price}$</b>
            <div className='add_to_cart' onClick={() => this.props.onAdd(this.props.item)}>+</div>
        </div>    
      </div>
    )
  }
}

export default ShowFullItem