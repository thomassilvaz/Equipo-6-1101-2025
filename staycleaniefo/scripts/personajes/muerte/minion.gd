extends CharacterBody2D

@onready var player = get_parent().find_child("jugador")
@onready var animation = $AnimatedSprite2D
 
func _ready():
	set_physics_process(false)
	await animation.animation_finished
	set_physics_process(true)
	animation.play("idle")
	AudioPlayer.play_fx("res://Audio/FX/risa.mp3")
 
func _physics_process(_delta):
	var direction = player.position - position
	velocity = direction.normalized() * 666
	move_and_slide()
 
func take_damage():
	set_physics_process(false)
	animation.play("death")
	await animation.animation_finished
	queue_free()
