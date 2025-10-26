extends CanvasLayer

signal on_transition_finished

@onready var color_rect = $ColorRect
@onready var animation_player = $AnimationPlayer

#desactiva la visibilidad por automatico
func _ready():
	color_rect.visible = false
	animation_player.animation_finished.connect(_on_animation_finished)

#emite la señal de transicion de escena segun la animacion
func _on_animation_finished(anim_name):
	if anim_name == "aparicion":
		on_transition_finished.emit()
		animation_player.play("desaparicion")
	elif anim_name == "desaparicion":
		color_rect.visible = false

#funcion que activa la animacion de transicion de escena
func transition():
	color_rect.visible = true
	AudioPlayer.play_fx("res://Audio/FX/sonido_transicion.wav")
	animation_player.play("aparicion")
