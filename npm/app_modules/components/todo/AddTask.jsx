import React       from 'react';
import Styles      from 'styles/todo';
import { connect } from 'react-redux';
import { addTask } from 'actions/todo';


const AddTask = ({ dispatch, state }) => {
	let inputText, inputExecutor;

	const submitTask = (e) => {
		e.preventDefault();

		if (!inputText.value.trim())
		{
			return;
		}

		dispatch(addTask({
			text    : inputText.value,
			executor: inputExecutor.value.trim() ? inputExecutor.value : 'All'
		}));

		inputText.value     = '';
		inputExecutor.value = '';
	};

	return (
		<form onSubmit={submitTask}>
			<input className={Styles.task_form_text} placeholder="New task..." ref={node => inputText = node} />
			<input className={Styles.task_form_executor} placeholder="Who..." ref={node => inputExecutor = node} />
			<input className={Styles.task_form_submit} type="submit" value="Add"/>
		</form>
	);
};

export default connect()(AddTask);