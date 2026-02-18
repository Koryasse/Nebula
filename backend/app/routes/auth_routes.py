# app/routes/auth_routes.py
from fastapi import APIRouter, Depends, HTTPException, Response
from sqlalchemy.orm import Session
from .. import models, schemas, auth
from ..database import SessionLocal

router = APIRouter()

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

@router.post("/register")
def register(user: schemas.UserCreate, db: Session = Depends(get_db)):
    hashed = auth.hash_password(user.password)

    new_user = models.User(
        email=user.email,
        username=user.username,
        password=hashed
    )

    db.add(new_user)
    db.commit()
    return {"message": "Utilisateur créé"}

@router.post("/login")
def login(user: schemas.UserLogin, response: Response, db: Session = Depends(get_db)):
    db_user = db.query(models.User).filter(models.User.email == user.email).first()

    if not db_user or not auth.verify_password(user.password, db_user.password):
        raise HTTPException(status_code=401, detail="Identifiants invalides")

    token = auth.create_access_token({"sub": db_user.email})

    response.set_cookie(
        key="access_token",
        value=token,
        httponly=True,
        secure=False,
        samesite="Lax"
    )

    return {"message": "Connexion réussie"}
