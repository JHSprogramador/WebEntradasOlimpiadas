import { TestBed } from '@angular/core/testing';

import { Auth0TokenVerifierService } from './auth0-token-verifier.service';

describe('Auth0TokenVerifierService', () => {
  let service: Auth0TokenVerifierService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(Auth0TokenVerifierService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
