extends Node2D

var current_state: State
var previous_state: State

#define el estado actual y el previo
func _ready():
	current_state = get_child(0) as State
	previous_state = current_state
	current_state.enter()

#cambia al estado que ha sido llamado y deja el previo
func change_state(state):
	current_state = find_child(state) as State
	current_state.enter()
 
	previous_state.exit()
	previous_state = current_state
