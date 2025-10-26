extends Node

#variables que determinan la animacion a mostrar y en que nodo está
@export var cutscene_id: String = "intro_cutscene"
@export var animation_player: AnimationPlayer
@export var nombre_escena: String = ""

#señales para detectar el estado de la escena
signal cutscene_started
signal cutscene_ended

var is_cutscene_active: bool = false

#se cancela si ya una animacion rodando
func _ready():
	if Estados.has_played_cutscene(cutscene_id):
		return

func start_cutscene():
	if is_cutscene_active:
		return
	
	is_cutscene_active = true
	cutscene_started.emit() #declara que una animacion esta en progreso y emite la señal
	
	var player = get_tree().get_nodes_in_group("Jugador")
	var jugador = player[0]
	jugador.activar_movimiento(false) #desactiva el movimiento del personaje que este en el grupo "Jugador"
	
	animation_player.play(nombre_escena)
	await animation_player.animation_finished
	_end_cutscene()
	jugador.activar_movimiento(true) #llama la funcion de acabar escena y reactiva el movimiento del jugador

#emite la señal de que se acabo la escena y la marca globalmente como completada
func _end_cutscene():
	is_cutscene_active = false
	cutscene_ended.emit()
	Estados.mark_cutscene_played(cutscene_id)

#activa el dialogo al llamarse, y desactiva la animacion hasta que este acabe
func trigger_dialogue(dialogue_resource: DialogueResource, dialogue_start: String):
	animation_player.pause()
	
	DialogueManager.show_example_dialogue_balloon(dialogue_resource, dialogue_start)
	await DialogueManager.dialogue_ended
	
	animation_player.play()
	
func sonido_puerta():
	AudioPlayer.play_fx("res://Audio/FX/sonido_transicion.wav")
