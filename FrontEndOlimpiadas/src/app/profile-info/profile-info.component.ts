import { DOCUMENT, CommonModule } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';
import { AuthService } from '@auth0/auth0-angular';
import { IonicModule } from '@ionic/angular';
import { ServiceService, User } from '../service.service';

@Component({
  selector: 'app-profile-info',
  templateUrl: './profile-info.component.html',
  styleUrls: ['./profile-info.component.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})
export class ProfileInfoComponent  implements OnInit {

  isAuthenticated$ = this.auth.isAuthenticated$;

  user!: User;

  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService, private service: ServiceService) { }

  ngOnInit() {
    // Mostrar usuario obtenido
    this.service.getUser().then(user => {
      if (user) {
        this.user = user;
      }
    });
  }

}
