import { combineReducers } from 'redux'

const visibilityFilter = (state = 'SHOW_ALL', action) => 
{
  switch (action.type) 
  {
	case 'SET_VISIBILITY_FILTER': return action.filter
	default: return state
  }
}

const todos = (state = [], action) => 
{
  switch (action.type) 
  {
    case 'ADD_TODO':
      return [
        ...state,
        {
          id       : action.id,
          text     : action.text,
          completed: false
        }
      ]
    case 'TOGGLE_TODO':
      return state.map(todo =>
      	(todo.id === action.id) 
      		? {...todo, completed: !todo.completed}
      		: todo
      )
    default:
      return state
  }
}

const reducer = combineReducers({ 
	todos, 
	visibilityFilter 
})

export default reducer