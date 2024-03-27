import { AuthService } from '@auth0/auth0-angular';
import { Component, OnInit } from '@angular/core';
import { IonButton } from '@ionic/angular/standalone';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-auth-button',
  templateUrl: './auth-button.component.html',
  styleUrls: ['./auth-button.component.scss'],
  standalone: true,
  imports:[IonButton, CommonModule]
})
export class AuthButtonComponent  implements OnInit {

  constructor(public auth: AuthService) { }

  ngOnInit() {}

}
