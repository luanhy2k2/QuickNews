import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LeftbarAdminComponent } from './leftbar-admin.component';

describe('LeftbarAdminComponent', () => {
  let component: LeftbarAdminComponent;
  let fixture: ComponentFixture<LeftbarAdminComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [LeftbarAdminComponent]
    });
    fixture = TestBed.createComponent(LeftbarAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
