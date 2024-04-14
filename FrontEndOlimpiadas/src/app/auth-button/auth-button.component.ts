import { AuthService } from '@auth0/auth0-angular';
import { Component, Inject, OnInit, ViewChild } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { ServiceService } from '../service.service';

@Component({
  selector: 'app-auth-button',
  templateUrl: './auth-button.component.html',
  styleUrls: ['./auth-button.component.scss'],
  standalone: true,
  imports:[CommonModule, IonicModule]
})
export class AuthButtonComponent  implements OnInit {
  isAuthenticated$ = this.auth.isAuthenticated$
  service!: ServiceService;
  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService) { }
 
  ngAfterViewInit() {
    this.service = new ServiceService(this.auth);
    // Verifica si el ng-container se ha renderizado
    if ((this.auth.user$) !== null) {
      // Llama a tu función aquí
     
      this.service.pushUser();
    }
  }
  // eslint-disable-next-line @angular-eslint/no-empty-lifecycle-method
  ngOnInit() {}

}
