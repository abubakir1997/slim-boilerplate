import React    from 'react'
import ReactDOM from 'react-dom'
import reducer  from 'apps/reducers/counter'
import Counter  from 'apps/components/counter'
import {
	createStore 
} from 'redux'

// Store
let store = createStore(reducer)

// Subscribe
store.subscribe(() => ReactDOM.render(
	<Counter 
	state={store.getState()}
	onInc={() => store.dispatch({ type: 'INC' })}
	onDec={() => store.dispatch({ type: 'DEC' })} />,
	document.getElementById('react-counter')
)); 

// Init
store.dispatch({ type: 'INIT' })