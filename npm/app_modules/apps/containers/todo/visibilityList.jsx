import { connect }    from 'react-redux'
import { toggleTodo } from 'apps/actions/todo'
import List           from 'apps/components/todo/list'

const getVisibleTodos = (todos, filter) => 
{
  switch (filter) 
  {
    case 'SHOW_COMPLETED': return todos.filter(t => t.completed)
    case 'SHOW_ACTIVE'   : return todos.filter(t => !t.completed)
    case 'SHOW_ALL'      :
    default              : return todos
  }
}

const mapStateToProps = state => 
{
  return {
    todos: getVisibleTodos(state.todos, state.visibilityFilter)
  }
}

const mapDispatchToProps = dispatch => 
{
  return {
    onTodoClick: id => 
    {
      dispatch(toggleTodo(id))
    }
  }
}

const VisibleList = connect(
  mapStateToProps,
  mapDispatchToProps
)(List)

export default VisibleList