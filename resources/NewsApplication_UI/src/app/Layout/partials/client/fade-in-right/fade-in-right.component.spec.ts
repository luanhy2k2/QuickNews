import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FadeInRightComponent } from './fade-in-right.component';

describe('FadeInRightComponent', () => {
  let component: FadeInRightComponent;
  let fixture: ComponentFixture<FadeInRightComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [FadeInRightComponent]
    });
    fixture = TestBed.createComponent(FadeInRightComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
