extends CanvasLayer

signal on_transition_finished

@onready var color_rect = $ColorRect
@onready var animation_player = $AnimationPlayer

func _ready():
	color_rect.visible = false
	animation_player.animation_finished.connect(_on_animation_finished)
	
func _on_animation_finished(anim_name):
	if anim_name == "aparicion":
		on_transition_finished.emit()
		animation_player.play("desaparicion")
	elif anim_name == "desaparicion":
		color_rect.visible = false
		
func transition():
	color_rect.visible = true
	AudioPlayer.play_fx("res://audio/fx/sonido_transicion.wav")
	animation_player.play("aparicion")
