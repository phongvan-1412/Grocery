import React from "react";
import ReactDOM from 'react-dom';
export default function Component(){
    return (
        <h1>Hello, My name is Van</h1>
    );
}

if(document.getElementById('react-component')){
    ReactDOM.render(
       <Component />, document.getElementById('react-component') 
    )
}