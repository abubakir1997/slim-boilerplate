import React     from 'react'
import PropTypes from 'prop-types'
import Task      from 'apps/components/todo/task'

const List = ({ todos, onTodoClick }) => (
  <div> 
  {
    todos.map(todo => (
      <Task key={todo.id} {...todo} onClick={() => onTodoClick(todo.id)} />
    ))
  }
  </div>
)

List.propTypes = 
{
  todos: PropTypes.arrayOf(
    PropTypes.shape({
      id       : PropTypes.number.isRequired,
      completed: PropTypes.bool.isRequired,
      text     : PropTypes.string.isRequired
    }).isRequired
  ).isRequired,
  onTodoClick: PropTypes.func.isRequired
}

export default List