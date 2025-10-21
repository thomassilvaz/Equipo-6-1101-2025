extends Area2D

var direction = Vector2.RIGHT
var speed = 500
 
func _physics_process(delta):
	position += direction * speed * delta
 
 
func _on_body_entered(body):
	body.take_damage()
 
 
func _ready() -> void:
	$AudioStreamPlayer2D.play()
	var animacion = $AnimationPlayer
	animacion.play("ataque")
	await animacion.animation_finished
	queue_free()
