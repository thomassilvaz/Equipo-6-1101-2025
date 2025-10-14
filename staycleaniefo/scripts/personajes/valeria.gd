extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true
