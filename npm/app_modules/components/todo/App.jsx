import React 	from 'react';
import Title 	from 'components/todo/Title';
import AddTask 	from 'components/todo/AddTask';
import Board 	from 'components/todo/Board';
import Styles 	from 'styles/todo';

const App = () => (
    <div className={Styles.app}>
        <Title />
        <AddTask />
        <Board />
    </div>
);

export default App;