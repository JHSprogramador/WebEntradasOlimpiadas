import { DOCUMENT, CommonModule } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';
import { AuthService } from '@auth0/auth0-angular';
import { IonicModule } from '@ionic/angular';

@Component({
  selector: 'app-profile-info',
  templateUrl: './profile-info.component.html',
  styleUrls: ['./profile-info.component.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule],
})
export class ProfileInfoComponent  implements OnInit {

  isAuthenticated$ = this.auth.isAuthenticated$;
  constructor(@Inject(DOCUMENT) public document: Document, public auth: AuthService) {}
  // eslint-disable-next-line @angular-eslint/no-empty-lifecycle-method
  ngOnInit() {}

}
