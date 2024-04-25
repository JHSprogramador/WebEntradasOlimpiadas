import { AuthService } from '@auth0/auth0-angular';
import { Component, Inject, OnInit, ViewChild } from '@angular/core';
import { CommonModule, DOCUMENT } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { ServiceService } from '../service.service';
import { EventsComponent } from '../events/events.component';

const mydate: string = '2024/03/31';
@Component({
  selector: 'app-auth-button',
  templateUrl: './auth-button.component.html',
  styleUrls: ['./auth-button.component.scss'],
  standalone: true,
  imports: [CommonModule, IonicModule, EventsComponent],
})
export class AuthButtonComponent  implements OnInit {
  isAuthenticated$ = this.auth.isAuthenticated$
  service!: ServiceService;
  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService) { }

  ngAfterViewInit() {

  }




  // eslint-disable-next-line @angular-eslint/no-empty-lifecycle-method
ngOnInit() {
  this.service = new ServiceService(this.auth);
  this.auth.isAuthenticated$.subscribe(isAuthenticated => {
    if (isAuthenticated) {
      // Llama a tu función aquí
      this.service.pushUser();
    }
  });
}

  currentDate: Date = new Date();
  fechaLimite: Date = new Date(2024, 2, 30);
  dateCompare() {
    if (this.currentDate >= this.fechaLimite) {
      return true;
    }
    return false;
  }
}
